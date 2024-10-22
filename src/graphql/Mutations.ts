import { gql } from "@apollo/client";

export const CREATE_PRODUCT = gql`
  mutation CreateProduct($product: ProductInput!) {
    createProduct(product: $product) {
      id
      sku
      name
      price
      productAttributes {
        attribute {
          id
          name
        }
        value
      }
    }
  }
`;

export const DELETE_PRODUCTS = gql`
  mutation DeleteProducts($id: [ID!]!) {
    deleteProduct(id: $id)
  }
`;
