import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "@irontec/ivoz-ui/services/entity/EntityService";

export type BillableCallPropertyList<T> = {
    'attr'?: T,
    'startTime'?: T,
    'callid'?: T,
    'caller'?: T,
    'callee'?: T,
    'destinationName'?: T,
    'direction'?: T,
    'invoice'?: T,
    'price'?: T,
    'duration'?: T,
    'cost'?: T,
    'carrierName'?: T,
    'ratingPlanName'?: T,
    'endpointType'?: T,
    'endpointId'?: T,
    'endpointName'?: T,
    'ddiProvider'?: T,
};

export type BillableCallProperties = BillableCallPropertyList<Partial<PropertySpec>>;

export type BillableCallPropertiesList = Array<BillableCallPropertyList<EntityValue | EntityValues>>;
