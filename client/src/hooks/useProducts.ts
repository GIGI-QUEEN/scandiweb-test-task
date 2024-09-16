import { useNavigate } from "react-router-dom";
import { useEffect, useState } from "react";
import { Product } from "../types/product";
import { axiosInstance } from "../api/axios";

export const useProducts = () => {
  const [products, setProducts] = useState<Product[]>([]);
  const navigate = useNavigate();

  const [selectedItems, setSelectedItems] = useState<number[]>([]);

  const handleItemToggle = (id: number) => {
    if (selectedItems.includes(id)) {
      setSelectedItems(selectedItems.filter((itemId) => itemId !== id));
    } else {
      setSelectedItems([...selectedItems, id]);
    }
  };

  const handleMassDelete = async () => {
    try {
      const res = await axiosInstance.delete("/products/delete", {
        data: {
          toDelete: selectedItems,
        },
      });

      if (res.status === 200) {
        fetchProducts();
        setSelectedItems([]);
      }
    } catch (error) {
      console.error("Ошибка при удалении товаров:", error);
    }
  };

  useEffect(() => {
    fetchProducts();
  }, []);

  const fetchProducts = async () => {
    await axiosInstance.get<Product[]>("/products").then((res) => {
      if (res.status === 200) {
        //console.log(res.data);
        setProducts(res.data);
      }
    });
  };

  return {
    products,
    navigate,
    handleItemToggle,
    handleMassDelete,
    selectedItems,
  };
};
