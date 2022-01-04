import * as React from 'react';
import EntityService, { EntityValues, VisualToggleStates } from 'lib/services/entity/EntityService';
import FormFieldFactory from 'lib/services/form/FormFieldFactory';
import { useFormikType } from 'lib/services/form/types';
import store from "store";
import { Grid } from '@mui/material';
import { PartialPropertyList, PropertySpec, ScalarProperty } from 'lib/services/api/ParsedApiSpecInterface';
import EntityInterface, { RowIconsType, ViewProps } from './EntityInterface';
import ViewFieldValue from 'lib/services/form/Field/ViewFieldValue';
import { StyledGroupLegend, StyledGroupGrid } from './DefaultEntityBehavior.styles';
import _ from 'lib/services/translations/translate';
import { CancelToken } from 'axios';

export const initialValues = {};

interface EntityValidatorValues { [label: string]: string }
type EntityValidatorResponse = Record<string, string | JSX.Element>;
export type EntityValidator = (values: EntityValidatorValues, properties: PartialPropertyList) => EntityValidatorResponse;

export const validator: EntityValidator = (values: EntityValidatorValues, properties: PartialPropertyList): EntityValidatorResponse => {

    const response: EntityValidatorResponse = {};
    for (const idx in values) {

        const pattern: RegExp | undefined = (properties[idx] as ScalarProperty)?.pattern;
        if (pattern && !values[idx].match(pattern)) {
            response[idx] = _('invalid pattern');
        }

        const required = (properties[idx] as ScalarProperty)?.required;
        if (required && values[idx] === '') {
            response[idx] = _('required value');
        }
    }

    return response;
}

export type MarshallerValues = { [key: string]: any };
export const marshaller = (values: MarshallerValues, properties: PartialPropertyList): MarshallerValues => {

    for (const idx in values) {

        const property: any = properties[idx];

        if (!property) {
            delete values[idx];
            continue;
        }

        if (property?.type === 'file') {

            if (values[idx].file) {
                values[idx] = values[idx].file;
            }

            continue;
        }

        if (property?.type === 'boolean') {
            values[idx] = values[idx] === '0'
                ? false
                : true;

            continue;
        }

        if (property?.$ref && values[idx] === '') {
            values[idx] = null;

            continue;
        }

        if (values[idx] === '__null__') {
            values[idx] = null;
        }
    }

    return values;
}

// API Response format => formik compatible format
export const unmarshaller = (row: MarshallerValues, properties: PartialPropertyList): MarshallerValues => {

    const normalizedData: any = {};

    // eslint-disable-next-line
    const dateTimePattern = `^[0-9]{4}\-[0-9]{2}\-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$`;
    const dateTimeRegExp = new RegExp(dateTimePattern);

    for (const idx in row) {
        if (row[idx] == null) {

            // formik doesn't like null values
            const property = properties[idx];
            normalizedData[idx] = property?.null
                ? '__null__'
                : '';

        } else if (typeof row[idx] === 'object' && row[idx].id) {
            // flatten foreign keys
            normalizedData[idx] = row[idx].id;
        } else if (typeof row[idx] === 'string' && row[idx].match(dateTimeRegExp)) {
            // formik datetime format: "yyyy-MM-ddThh:mm" followed by optional ":ss" or ":ss.SSS"
            normalizedData[idx] = row[idx].replace(' ', 'T');
        } else if (properties[idx] && (properties[idx] as ScalarProperty).type === "boolean") {
            normalizedData[idx] = row[idx] === true
                ? 1
                : 0;
        } else {
            normalizedData[idx] = row[idx];
        }
    }

    return normalizedData;
};

// eslint-disable-next-line @typescript-eslint/no-unused-vars
export const foreignKeyResolver = async (data: EntityValues, entityService: EntityService): Promise<EntityValues> => data;

export const foreignKeyGetter = async (): Promise<any> => {
    return {};
};

export const columns = [];

export const properties = {};

export const acl = {
    create: true,
    read: true,
    update: true,
    delete: true,
};

interface ListDecoratorProps {
    field: any,
    row: any,
    property: any
}

export const ListDecorator = (props: ListDecoratorProps): JSX.Element | string => {

    const { field, row, property } = props;
    let value = row[field];

    if (property.component) {
        return (
            <property.component _context={'read'} {...row} />
        );
    }

    if (property.type === 'file') {
        return value.baseName;
    }

    if (property.enum) {
        if (property.enum[value]) {
            value = property.enum[value];
        }
    }

    if (!value && property.null) {
        value = property.null;
    }

    return (value !== null && value !== undefined)
        ? value
        : '';
}

export const RowIcons: RowIconsType = (): JSX.Element => {
    return (
        <React.Fragment />
    );
};

export type FieldsetGroups = {
    legend: string | React.ReactElement,
    fields: Array<string | false | undefined>
}

export type PropertyFkChoices = {
    [key: string]: string | React.ReactElement<any>
};

export type NullablePropertyFkChoices = null | PropertyFkChoices;

export type FkChoices = null | {
    [key: string]: NullablePropertyFkChoices
};

export type EntityFormProps = EntityInterface & {
    create?: boolean,
    edit?: boolean,
    entityService: EntityService,
    formik: useFormikType,
    groups: Array<FieldsetGroups | false>,
    fkChoices: FkChoices,
    readOnlyProperties?: { [attribute: string]: boolean },
};

export type FormOnChangeEvent = React.ChangeEvent<{ name: string, value: any }>;

const filterFieldsetGroups = (groups: Array<FieldsetGroups | false>): Array<FieldsetGroups> => {

    const resp:Array<FieldsetGroups> = [];
    for (const idx in groups) {
        const group = groups[idx];

        if (!group) {
            continue;
        }

        const fields = group.fields.filter(
            (item) => typeof item === 'string'
        ) as Array<string>;

        if (!fields.length) {
            continue;
        }

        resp.push({
            legend: group.legend,
            fields
        });
    }

    return resp;
}


const Form = (props: EntityFormProps): JSX.Element => {

    const { entityService, formik, readOnlyProperties } = props;
    const { fkChoices } = props;

    const columns = entityService.getColumns();
    const columnNames = Object.keys(columns);

    let groups: Array<FieldsetGroups> = [];
    if (props.groups) {

        groups = filterFieldsetGroups(props.groups);

    } else {
        groups.push({
            legend: "",
            fields: columnNames
        });
    }

    let initialVisualToggles = entityService.getVisualToggles();
    const initialValues = formik.initialValues;
    for (const idx in initialValues) {
        initialVisualToggles = entityService.updateVisualToggle(
            idx,
            initialValues[idx],
            initialVisualToggles,
        );
    }

    const [visualToggles, setVisualToggles] = React.useState<VisualToggleStates>(initialVisualToggles);

    const formOnChangeHandler = (e: FormOnChangeEvent): void => {

        formik.handleChange(e);

        const { name, value } = e.target;
        const updatedVisualToggles = entityService.updateVisualToggle(
            name,
            value,
            { ...visualToggles },
        );

        setVisualToggles(updatedVisualToggles);
    };

    const formFieldFactory = new FormFieldFactory(
        entityService,
        formik,
        formOnChangeHandler
    );

    return (
        <React.Fragment>
            {groups.map((group, idx: number) => {

                const fields = group.fields as Array<string>;
                const visible = fields.reduce(
                    (acc: boolean, fld: string) => {
                        return acc || visualToggles[fld];
                    },
                    false
                );

                const visibilityStyles = visible
                    ? { display: 'block' }
                    : { display: 'none' };

                return (
                    <div key={idx} style={visibilityStyles}>
                        <StyledGroupLegend>
                            {group.legend}
                        </StyledGroupLegend>
                        <StyledGroupGrid>
                            {fields.map((columnName: string, idx: number) => {

                                const choices: NullablePropertyFkChoices = fkChoices
                                    ? fkChoices[columnName]
                                    : null;

                                const visibilityStyles = visualToggles[columnName]
                                    ? { display: 'block' }
                                    : { display: 'none' };

                                const readOnly = readOnlyProperties && readOnlyProperties[columnName]
                                    ? true
                                    : false;

                                return (
                                    <Grid item xs={12} md={6} lg={4} xl={3} key={idx} style={visibilityStyles}>
                                        {formFieldFactory.getFormField(columnName, choices, readOnly)}
                                    </Grid>
                                );
                            })}
                        </StyledGroupGrid>
                    </div>
                );
            })}
        </React.Fragment>
    );
};

const View = (props: ViewProps): JSX.Element | null => {

    const { entityService, row } = props;

    const columns = entityService.getColumns();
    const columnNames = Object.keys(columns);

    let groups: Array<FieldsetGroups> = [];
    if (props.groups) {
        groups = filterFieldsetGroups(props.groups);
    } else {
        groups.push({
            legend: "",
            fields: columnNames
        });
    }

    return (
        <React.Fragment>
            {groups.map((group, idx: number) => {

                const fields = group.fields as Array<string>;

                return (
                    <div key={idx}>
                        <StyledGroupLegend>
                            {group.legend}
                        </StyledGroupLegend>
                        <StyledGroupGrid>
                            {fields.map((columnName: string, idx: number) => {

                                const properties = entityService.getProperties();
                                const property = (properties[columnName] as PropertySpec);
                                return (
                                    <Grid item xs={12} md={6} lg={4} key={idx}>
                                        <ViewFieldValue property={property} values={row} columnName={columnName} />
                                    </Grid>
                                );
                            })}
                        </StyledGroupGrid>
                    </div>
                );
            })}
        </React.Fragment>
    );
};

export type FetchFksCallback = (data: { [key: string]: any }) => void;

const fetchFks = (endpoint: string, properties: Array<string>, setter: FetchFksCallback, cancelToken?: CancelToken): Promise<unknown> => {

    const getAction = store.getActions().api.get;
    return getAction({
        path: endpoint,
        params: {
            '_pagination': false,
            '_itemsPerPage': 100,
            '_properties': properties
        },
        successCallback: async (data: any) => {
            setter(data);
        },
        cancelToken
    });
}

const DefaultEntityBehavior = {
    initialValues,
    validator,
    marshaller,
    unmarshaller,
    foreignKeyResolver,
    foreignKeyGetter,
    columns,
    properties,
    acl,
    ListDecorator,
    toStr: (row: EntityValues): string => {
        return (row.id as string || '[*]');
    },
    RowIcons,
    Form,
    View,
    fetchFks,
    defaultOrderBy: 'id',
};

export default DefaultEntityBehavior;