import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type BillableCallPropertyList<T> = {
  brand?: T;
  callee?: T;
  caller?: T;
  company?: T;
  cost?: T;
  direction?: T;
  duration?: T;
  invoice?: T;
  price?: T;
  startTime?: T;
  callid?: T;
  carrierName?: T;
  destinationName?: T;
  ratingPlanName?: T;
  endpointType?: T;
  endpointId?: T;
  endpointName?: T;
  id?: T;
  carrier?: T;
  destination?: T;
  ratingPlanGroup?: T;
  ddi?: T;
  ddiProvider?: T;
};

export type BillableCallProperties = BillableCallPropertyList<
  Partial<PropertySpec>
>;
export type BillableCallPropertiesList = Array<
  BillableCallPropertyList<EntityValue | EntityValues>
>;
