import { useState } from "react";

export const useAddProduct = () => {
  const [option, setOption] = useState<string>("DVD");

  const handleOptionChange = (option: string) => {
    setOption(option);
  };

  return { option, setOption, handleOptionChange };
};
