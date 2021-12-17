import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type RecordingPropertyList<T> = {
    'callid'?: T,
    'calldate'?: T,
    'duration'?: T,
    'caller'?: T,
    'callee'?: T,
    'type'?: T,
    'typeGhost'?: T,
    'recordedFile'?: T,
};

export type RecordingProperties = RecordingPropertyList<Partial<PropertySpec>>;
export type RecordingPropertiesList = Array<RecordingPropertyList<EntityValue|EntityValues>>;