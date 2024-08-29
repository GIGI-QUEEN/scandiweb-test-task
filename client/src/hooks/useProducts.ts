import { useNavigate } from "react-router-dom";
import { fakeData } from "../api/fakeData";
import { useState } from "react";
import { Product } from "../types/product";

export const useProducts = () => {
  const [products, setProducts] = useState(fakeData);
  const navigate = useNavigate();

  const [selectedItems, setSelectedItems] = useState<string[]>([]);

  const handleItemToggle = (productSku: string) => {
    if (selectedItems.includes(productSku)) {
      setSelectedItems(selectedItems.filter((sku) => sku !== productSku));
    } else {
      setSelectedItems([...selectedItems, productSku]);
    }
  };

  const handleMassDelete = () => {
    // console.log(itemsToDelete);
    const newArr = products.filter(
      (product) => !selectedItems.includes(product.sku)
    );
    setProducts(newArr);
    setSelectedItems([]);
    //console.log(products);
  };

  return {
    products,
    navigate,
    handleItemToggle,
    handleMassDelete,
    selectedItems,
  };
};
