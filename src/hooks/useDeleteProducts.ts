import { useMutation } from "@apollo/client";
import { DELETE_PRODUCTS } from "../graphql/Mutations";
import { GET_PRODUCTS } from "../graphql/Queries";

const useDeleteProducts = () =>
  useMutation<{ deleteProduct: string[] }, { id: string[] }>(DELETE_PRODUCTS, {
    refetchQueries: [{ query: GET_PRODUCTS }],
  });

export default useDeleteProducts;
