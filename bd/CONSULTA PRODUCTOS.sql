SELECT tbk_producto.id_pro, tbk_producto.codigo_pro, tbk_producto.nombre_pro,tbk_producto_valor.id_pro,tbk_producto_valor.cbarra_pro  , tbk_producto_valor.precio_efectivo_pv,tbk_stock.id_pro , tbk_stock.stock_stk
FROM   tbk_producto,tbk_producto_valor, tbk_stock
WHERE  tbk_producto.codigo_pro  LIKE  '%408PRA97%'
AND	   tbk_producto_valor.cbarra_pro  LIKE  '%408PRA97%'
AND 	tbk_stock.id_pro = tbk_producto.id_pro




SELECT tbk_producto.id_pro, tbk_producto.codigo_pro, tbk_producto.nombre_pro,tbk_producto_valor.id_pro,tbk_producto_valor.cbarra_pro  , tbk_producto_valor.precio_efectivo_pv,tbk_stock.id_pro , tbk_stock.stock_stk
FROM   tbk_producto,tbk_producto_valor, tbk_stock
WHERE  tbk_producto.nombre_pro LIKE '%ESPARRAGO%'
AND 	tbk_stock.id_pro = tbk_producto.id_pro
GROUP BY tbk_producto.codigo_pro