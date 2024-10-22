import { useMutation } from "@apollo/client";
import { CREATE_PRODUCT } from "../graphql/Mutations";
import { Product, ProductInput } from "../services/types";

const useCreateProduct = () => {
  return useMutation<{ createProduct: Product }, { product: ProductInput }>(
    CREATE_PRODUCT
  );
};

export default useCreateProduct;
