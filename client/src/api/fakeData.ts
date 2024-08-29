import { Book, DVD, Furniture } from "../types/product";

const dvd: DVD = {
  size: 500,
  sku: "111",
  name: "Some DVD",
  price: 10,
};
const dvd1: DVD = {
  size: 500,
  sku: "111222",
  name: "Some DVD",
  price: 10,
};
const dvd2: DVD = {
  size: 500,
  sku: "111333",
  name: "Some DVD",
  price: 10,
};

const book: Book = {
  weight: 150,
  sku: "222",
  name: "Bible",
  price: 15,
};
const book1: Book = {
  weight: 150,
  sku: "222333",
  name: "Bible",
  price: 15,
};
const book2: Book = {
  weight: 150,
  sku: "222444",
  name: "Bible",
  price: 15,
};

const sofa: Furniture = {
  dimensions: {
    height: 50,
    widht: 100,
    length: 40,
  },
  sku: "333",
  name: "Sofa",
  price: 50,
};
const sofa1: Furniture = {
  dimensions: {
    height: 50,
    widht: 100,
    length: 40,
  },
  sku: "333444",
  name: "Sofa",
  price: 50,
};
const sofa2: Furniture = {
  dimensions: {
    height: 50,
    widht: 100,
    length: 40,
  },
  sku: "333555",
  name: "Sofa",
  price: 50,
};

export const fakeData = [
  dvd,
  dvd1,
  dvd2,
  book,
  book1,
  book2,
  sofa,
  sofa1,
  sofa2,
];
