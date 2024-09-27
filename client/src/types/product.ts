export interface Product {
  sku: string;
  name: string;
  price: number;
  id: number;
}

export interface DVD extends Product {
  size: number;
}
export interface Book extends Product {
  weight: number;
}
export interface Furniture extends Product {
  height: number;
  width: number;
  length: number;
}
