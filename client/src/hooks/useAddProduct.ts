import { useState } from "react";
import { SubmitHandler, useFormContext } from "react-hook-form";
import { ProductAddValidationSchema } from "../validation/productAddValidationSchema";

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
  }) => {
    console.log("SKU:", sku);
    console.log("Name:", name);
    console.log("Price:", price);
    console.log("height:", height);
    console.log("weight:", weight);
    console.log("length:", length);
    console.log("size:", size);
    console.log("width:", width);
  };

  return { option, setOption, handleOptionChange, onSubmit };
};
