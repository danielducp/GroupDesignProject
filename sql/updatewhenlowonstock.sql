UPDATE product
SET
   CurrentStockLevel = `CurrentStockLevel`+`QuantityPerPack`
WHERE `CurrentStockLevel` < `LowStockLevel` ;