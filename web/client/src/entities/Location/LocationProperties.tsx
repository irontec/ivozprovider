import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type LocationPropertyList<T> = {
  name?: T;
  description?: T;
};

export type LocationProperties = LocationPropertyList<Partial<PropertySpec>>;

export type LocationPropertiesList = Array<
  LocationPropertyList<EntityValue | EntityValues>
>;
