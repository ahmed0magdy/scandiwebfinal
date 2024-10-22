import { ProductInput } from "../services/types";

const validateProduct = (
  product: ProductInput,
  selectedCategory: string
): string[] => {
  const errors: string[] = [];

  const validateProductData = (
    sku: string,
    name: string,
    price: number | null,
    selectedCategory: string
  ): void => {
    if (
      !sku ||
      !name ||
      !selectedCategory ||
      !product.attributes ||
      product.attributes.some((attr) => !attr.value)
    ) {
      errors.push("Please, submit required data");
    }
    if (!price || isNaN(price) || price < 0) {
      errors.push("Please, provide the data of indicated type");
    }
  };

  validateProductData(
    product.sku,
    product.name,
    product.price,
    selectedCategory
  );

  return errors;
};

export default validateProduct;
