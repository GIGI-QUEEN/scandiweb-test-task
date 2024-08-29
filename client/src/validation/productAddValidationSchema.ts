import { z } from "zod";

/* export const productAddValidationSchema = z.object({
  sku: z.string().min(1, { message: "Please, provide SKU" }),
  name: z.string().min(1, { message: "Please, provide product's name" }),
  price: z.coerce.number().min(0.001, { message: "Please, provide price" }),
  size: z.coerce.number().min(1, { message: "Please, provide size" }),
  weight: z.coerce.number().min(0.001, { message: "Please, provide weight" }),
  height: z.coerce.number().min(1, { message: "Please, provide height" }),
  width: z.coerce.number().min(1, { message: "Please, provide width" }),
  length: z.coerce.number().min(1, { message: "Please, provide length" }),
}); */

export const productAddValidationSchema = z
  .object({
    sku: z.string().min(1, { message: "Please, provide SKU" }),
    name: z.string().min(1, { message: "Please, provide product's name" }),
    price: z.coerce.number().min(0.001, { message: "Please, provide price" }),
    type: z.enum(["DVD", "Book", "Furniture"], {
      message: "Please, select a product type",
    }),
    size: z.coerce
      .number()
      .min(1, { message: "Please, provide size" })
      .optional(),
    weight: z.coerce
      .number()
      .min(0.001, { message: "Please, provide weight" })
      .optional(),
    height: z.coerce
      .number()
      .min(1, { message: "Please, provide height" })
      .optional(),
    width: z.coerce
      .number()
      .min(1, { message: "Please, provide width" })
      .optional(),
    length: z.coerce
      .number()
      .min(1, { message: "Please, provide length" })
      .optional(),
  })
  .refine(
    (data) => {
      if (data.type === "DVD") {
        return data.size !== undefined;
      }
      if (data.type === "Book") {
        return data.weight !== undefined;
      }
      if (data.type === "Furniture") {
        return (
          data.height !== undefined &&
          data.width !== undefined &&
          data.length !== undefined
        );
      }
      return true;
    },
    {
      message:
        "Please, fill in the required fields for the selected product type",
      path: ["type"],
    }
  );

export type ProductAddValidationSchema = z.infer<
  typeof productAddValidationSchema
>;
