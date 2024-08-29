import React from "react";
import { FormProvider, useForm } from "react-hook-form";
import {
  productAddValidationSchema,
  ProductAddValidationSchema,
} from "../../validation/productAddValidationSchema";
import { zodResolver } from "@hookform/resolvers/zod";
import AddProductPage from "./AddProduct";

export const AddProductProvider = () => {
  const methods = useForm<ProductAddValidationSchema>({
    mode: "onSubmit",
    resolver: zodResolver(productAddValidationSchema),
  });
  return (
    <FormProvider {...methods}>
      <AddProductPage />
    </FormProvider>
  );
};
