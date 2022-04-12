import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type MatchListPatternPropertyList<T> = {
  'description'?: T,
  'type'?: T,
  'regexp'?: T,
  'numberCountry'?: T,
  'numbervalue'?: T,
  'matchList'?: T,
};

export type MatchListPatternProperties = MatchListPatternPropertyList<Partial<PropertySpec>>;
export type MatchListPatternPropertiesList = Array<MatchListPatternPropertyList<EntityValue | EntityValues>>;