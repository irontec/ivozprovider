import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type MatchListPatternPropertyList<T> = {
  description?: T;
  type?: T;
  regexp?: T;
  numbervalue?: T;
  id?: T;
  matchList?: T;
  numberCountry?: T;
  matchValue?: T;
};

export type MatchListPatternProperties = MatchListPatternPropertyList<
  Partial<PropertySpec>
>;
export type MatchListPatternPropertiesList = Array<
  MatchListPatternPropertyList<EntityValue | EntityValues>
>;
