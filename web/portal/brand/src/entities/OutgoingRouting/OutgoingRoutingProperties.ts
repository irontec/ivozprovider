import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type OutgoingRoutingPropertyList<T> = {
  type?: T;
  priority?: T;
  weight?: T;
  routingMode?: T;
  prefix?: T;
  stopper?: T;
  forceClid?: T;
  clid?: T;
  id?: T;
  company?: T;
  destination?: T;
  carrier?: T;
  routingPattern?: T;
  routingPatternGroup?: T;
  routingTag?: T;
  clidCountry?: T;
  carrierIds?: T;
  carriers?: T;
};

export type OutgoingRoutingProperties = OutgoingRoutingPropertyList<
  Partial<PropertySpec>
>;
export type OutgoingRoutingPropertiesList = Array<
  OutgoingRoutingPropertyList<EntityValue | EntityValues>
>;
