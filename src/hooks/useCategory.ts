import { useQuery } from "@apollo/client";
import { GET_CATEGORIES } from "../graphql/Queries";
import { Category } from "../services/types";

const useCategory = () => useQuery<{ categories: Category[] }>(GET_CATEGORIES);
export default useCategory;
