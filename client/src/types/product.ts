export interface Product {
  sku: string;
  name: string;
  price: number;
}

export interface DVD extends Product {
  size: number;
}
export interface Book extends Product {
  weight: number;
}
export interface Furniture extends Product {
  dimensions: Dimensions;
}

type Dimensions = {
  height: number;
  widht: number;
  length: number;
};
