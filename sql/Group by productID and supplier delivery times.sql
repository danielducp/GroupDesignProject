SELECT * FROM product INNER JOIN suppliedproducts ON product.ProductID = suppliedproducts.ProductID
GROUP BY product.ProductID, DeliveryTime,  SupplierID


