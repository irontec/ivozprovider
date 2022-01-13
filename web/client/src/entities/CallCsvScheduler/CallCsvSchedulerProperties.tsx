import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type CallCsvSchedulerPropertyList<T> = {
    'attr'?: T,
    'name'?: T,
    'callDirection'?: T,
    'frequency'?: T,
    'unit'?: T,
    'email'?: T,
    'lastExecution'?: T,
    'lastExecutionError'?: T,
    'nextExecution'?: T,
    'brand'?: T,
    'callCsvNotificationTemplate'?: T,
    'ddi'?: T,
    'retailAccount'?: T,
    'residentialDevice'?: T,
    'endpointType'?: T,
    'user'?: T,
    'fax'?: T,
    'friend'?: T,
};

export type CallCsvSchedulerProperties = CallCsvSchedulerPropertyList<Partial<PropertySpec>>;
export type CallCsvSchedulerPropertiesList = Array<CallCsvSchedulerPropertyList<EntityValue | EntityValues>>;