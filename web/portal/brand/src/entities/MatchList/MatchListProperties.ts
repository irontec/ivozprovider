import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type MatchListPropertyList<T> = {
  name?: T;
  id?: T;
};

export type MatchListProperties = MatchListPropertyList<Partial<PropertySpec>>;
export type MatchListPropertiesList = Array<
  MatchListPropertyList<EntityValue | EntityValues>
>;
