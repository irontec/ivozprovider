import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type BillableCallPropertyList<T> = {
  callid?: T;
  startTime?: T;
  duration?: T;
  caller?: T;
  callee?: T;
  cost?: T;
  price?: T;
  carrierName?: T;
  destinationName?: T;
  ratingPlanName?: T;
  endpointType?: T;
  endpointId?: T;
  endpointName?: T;
  direction?: T;
  id?: T;
  company?: T;
  carrier?: T;
  destination?: T;
  ratingPlanGroup?: T;
  invoice?: T;
  ddi?: T;
  ddiProvider?: T;
};

export type BillableCallProperties = BillableCallPropertyList<Partial<PropertySpec>>;
export type BillableCallPropertiesList = Array<BillableCallPropertyList<EntityValue | EntityValues>>;
