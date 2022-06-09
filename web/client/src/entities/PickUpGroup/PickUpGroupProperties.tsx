import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import {
  EntityValue,
  EntityValues,
} from "@irontec/ivoz-ui/services/entity/EntityService";

export type PickUpGroupPropertyList<T> = {
  name?: T;
  userIds?: T;
};

export type PickUpGroupProperties = PickUpGroupPropertyList<
  Partial<PropertySpec>
>;
export type PickUpGroupPropertiesList = Array<
  PickUpGroupPropertyList<EntityValue | EntityValues>
>;
