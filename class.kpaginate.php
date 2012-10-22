<?php
/*
 *      class.kpaginate.php v1.2
 *
 *      Copyright 2009 Ismael Rodríguez <el.quick@gmail.com>
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

	class kpaginate{

		private $ends				= 2			;
		private $show				= 10		;
		private $num_pgs			= 0			;
		private $total_items		= 0			;
		private $items_pg			= 0			;
		private $pg					= 0			;
		private $prefix				= 'kpg'		;
		private $start				= 0			;
		private $stop				= 0			;
		private $getvars			= array()	;
		private $without_numbers	= false		;
		private $customvar			= ''		;
		private $first_page_is		= 0			;
		public static $correlative	= 0			;

		function __construct(){

			self::$correlative++ ;
			$this->getvars = $_GET ;
		}
		
		public function firstPageIs($pg){
			$this->first_page_is = intval($pg);
		}		

		public function withoutNumbers($bool){
			$this->without_numbers = $bool ;
		}

		public function getLimit(){
			return array((($this->pg - $this->first_page_is) * $this->items_pg), $this->items_pg) ;
		}

		public function setTotalItems($total_items){

			$this->total_items = intval($total_items) ;

			if($this->items_pg > 0){

				$this->setNumPages() ;

				if($this->customvar != ''){
					$this->setCustomPage() ;
				}
				elseif(isset($this->getvars[$this->prefix][self::$correlative])){
					$this->setPage($this->getvars[$this->prefix][self::$correlative]) ;
				}
				else{
					$this->setPage($this->first_page_is) ;
				}
			}
		}

		public function setItemsPerPage($items_pg){

			$this->items_pg = intval($items_pg) ;

			if($this->total_items > 0){

				$this->setNumPages() ;

				if($this->customvar != ''){
					$this->setCustomPage() ;
				}
				elseif(isset($this->getvars[$this->prefix][self::$correlative])){
					$this->setPage($this->getvars[$this->prefix][self::$correlative]) ;
				}
				else{
					$this->setPage($this->first_page_is) ;
				}
			}
		}

		private function setNumPages(){
			$this->num_pgs = ceil($this->total_items / $this->items_pg) ;
		}

		private function setCustomPage(){

			$pg		= 0 ;
			$getstr	= '' ;

			if(isset($this->getvars[$this->customvar])){

				parse_str($this->customvar, $ctmout) ;

				while(is_array($ctmout)){
					$getstr .= '[\'' . current(array_keys($ctmout)) . '\']'	;
					$ctmout = current(array_values($ctmout))		;
				}
				eval('$pg = intval($this->getvars' . $getstr . ') ; ')		;
			}

			if($pg > $this->first_page_is && $pg < $this->num_pgs + $this->first_page_is)
				$this->pg = $pg ;
			else
				$this->pg = $this->first_page_is ;
		}

		private function setPage($pg){

			$pg = intval($pg) ;
	
			if($pg > $this->first_page_is && $pg < $this->num_pgs + $this->first_page_is)
				$this->pg = $pg ;
			else
				$this->pg = $this->first_page_is ;
		}

		private function createPageLink($pg){

			$pg = intval($pg) - 1 ;
			$pg += $this->first_page_is ;

			if($this->pg == $pg)
				return ' class="selected" ' ;

			if($this->customvar != ''){

				$customurl = urldecode(http_build_query($this->getvars) . '&' . $this->customvar . '=' . $pg) ;
				parse_str($customurl, $urlout) ;
				$lnk = 'href="?' . urldecode(http_build_query($urlout)) . '"' ;
			}
			else{
				$this->getvars[$this->prefix][self::$correlative] = $pg ;
				$lnk = 'href="?' . urldecode(http_build_query($this->getvars)) . '"' ;
			}

			return $lnk ;
		}

		public function setCustomVar($varname = ''){

			if(trim($varname) != '')
				$this->customvar = trim(strval($varname)) ;
		}

		private function calculateBuffers(){

			$this->left = $this->right = ceil($this->show / 2) ;

			$this->start	= ($this->pg + 1)	- $this->left	;
			$this->stop		= ($this->pg + 1)	+ $this->right	;

			if($this->start < 1){

				$this->start	= 1					;
				$this->stop		= $this->show + 1	;

				if($this->stop > $this->num_pgs)
					$this->stop = $this->num_pgs ;
			}

			if($this->stop > $this->num_pgs){

				$this->stop		= $this->num_pgs				;
				$this->start	= ($this->stop - $this->show)	;

				if($this->start < 1)
					$this->start = 1 ;
			}

			$this->start	+=	$this->ends	;
			$this->stop		-=	$this->ends	;
		}

		public function paginate(){

			if($this->total_items > $this->items_pg){

				echo '<table id="kpaginate" align="center" cellpadding="0" cellspacing="0"><tr>' ;
				echo '<td><a ' . ($this->pg > $this->first_page_is ? $this->createPageLink($this->pg - $this->first_page_is) . ' class="back" ' : ' class="backdis" ') . '></a></td>' ;

				if($this->without_numbers == false){
					if($this->num_pgs <= $this->show){

						for($i = 1 ; $i <= $this->num_pgs ; $i++)
							echo '<td><a ' . $this->createPageLink($i) . ' class="normal">' . ($i) . '</a></td>' ;
					}
					else{

						$this->calculateBuffers() ;

						for($i = 1 ; $i <= $this->ends ; $i++)
							echo '<td><a ' . $this->createPageLink($i) . ' class="normal">' . ($i) . '</a></td>' ;

						if($i != $this->start)
							echo '<td>...</td>' ;

						for($i = $this->start ; $i <= $this->stop ; $i++)
							echo '<td><a ' . $this->createPageLink($i) . ' class="normal">' . ($i) . '</a></td>' ;

						if($i != ($this->num_pgs - ($this->ends - 1)))
							echo '<td>...</td>' ;

						for($i = ($this->num_pgs - ($this->ends - 1)) ; $i <= $this->num_pgs ; $i++)
							echo '<td><a ' . $this->createPageLink($i) . ' class="normal">' . ($i) . '</a></td>' ;
					}
				}

				echo '<td><a ' . ($this->pg < $this->num_pgs - 1 + $this->first_page_is ? $this->createPageLink($this->pg + 2 - $this->first_page_is) . ' class="next" ' : ' class="nextdis" ') . '></a></td>' ;
				echo '</tr></table>' ;
			}
		}
	}
?>
