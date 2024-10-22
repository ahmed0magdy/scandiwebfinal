import { ProductInput } from "../services/types";

const validateProduct = (
  product: ProductInput,
  selectedCategory: string
): string[] => {
  const errors: string[] = [];

  if (
    !product.sku ||
    !product.name ||
    !selectedCategory ||
    !product.attributes ||
    product.attributes.some((attr) => !attr.value)
  ) {
    errors.push("Please, submit required data");
  }

  if (!product.price || isNaN(product.price) || product.price < 0) {
    errors.push("Please, provide the data of indicated type");
  }

  return errors;
};

export default validateProduct;
