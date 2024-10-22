import { useQuery } from "@apollo/client";
import { GET_PRODUCTS } from "../graphql/Queries";
import { Product } from "../services/types";

const useProducts = () =>
  useQuery<{ products: Product[] }>(GET_PRODUCTS, {
    fetchPolicy: "cache-and-network",
  });
export default useProducts;
