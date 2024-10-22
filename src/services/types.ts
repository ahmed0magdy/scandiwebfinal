export interface Attribute {
  id: string;
  name: string;
}

export interface ProductAttribute {
  attribute: Attribute;
  value: string;
}

export interface Product {
  id: string;
  sku: string;
  name: string;
  price: number;
  productAttributes: ProductAttribute[];
}

export interface Category {
  id: string;
  name: string;
  attributes: Attribute[];
}

export interface ProductInput {
  sku: string;
  name: string;
  price: number | null;
  attributes: AttributeInput[];
}

export interface AttributeInput {
  id: string;
  value: string;
}
