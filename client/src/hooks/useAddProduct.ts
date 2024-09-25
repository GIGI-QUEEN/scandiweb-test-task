import { useState } from "react";
import { SubmitHandler, useFormContext } from "react-hook-form";
import { ProductAddValidationSchema } from "../validation/productAddValidationSchema";
import { axiosInstance } from "../api/axios";
import { useNavigate } from "react-router-dom";
import { homeRoute } from "../routes/RouteNames";

type FormFields =
  | "sku"
  | "name"
  | "price"
  | "type"
  | "length"
  | "size"
  | "weight"
  | "height"
  | "width";

export const useAddProduct = () => {
  const [option, setOption] = useState<string>("DVD");
  const navigate = useNavigate();

  const { resetField } = useFormContext<ProductAddValidationSchema>();

  const handleOptionChange = (option: string) => {
    setOption(option);
    resetFieldsOnChange();
  };

  const resetFieldsOnChange = () => {
    const fieldsToReset: FormFields[] = [
      "size",
      "weight",
      "height",
      "width",
      "length",
    ];
    fieldsToReset.forEach((field) => {
      resetField(field, undefined);
    });
  };

  const onSubmit: SubmitHandler<ProductAddValidationSchema> = async ({
    name,
    price,
    sku,
    height,
    weight,
    length,
    size,
    width,
    type,
  }) => {
    let product;
    switch (type) {
      case "DVD":
        product = { name, sku, price, type: type.toLowerCase(), size };
        break;
      case "Book":
        product = { name, sku, price, type: type.toLowerCase(), weight };
        break;
      case "Furniture":
        product = {
          name,
          sku,
          price,
          type: type.toLowerCase(),
          height,
          width,
          length,
        };
        break;
    }
    try {
      await axiosInstance.post("/product/create", product);
      navigate(homeRoute);
    } catch (error) {
      navigate(homeRoute);
    }
  };

  return { option, setOption, handleOptionChange, onSubmit };
};
