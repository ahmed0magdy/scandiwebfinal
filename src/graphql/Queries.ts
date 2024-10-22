import { gql } from "@apollo/client";

export const GET_PRODUCTS = gql`
  {
    products {
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

export const GET_CATEGORIES = gql`
  {
    categories {
      id
      name
      attributes {
        id
        name
      }
    }
  }
`;
