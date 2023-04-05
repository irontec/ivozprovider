import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type MatchListPropertyList<T> = {
  name?: T;
  generic?: T;
};

export type MatchListProperties = MatchListPropertyList<Partial<PropertySpec>>;
export type MatchListPropertiesList = Array<
  MatchListPropertyList<EntityValue | EntityValues>
>;
