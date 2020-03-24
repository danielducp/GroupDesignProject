SELECT * FROM product INNER JOIN suppliedproducts ON product.ProductID = suppliedproducts.ProductID
GROUP BY TotalCost ASC, SuppliedProductsID , product.ProductID
