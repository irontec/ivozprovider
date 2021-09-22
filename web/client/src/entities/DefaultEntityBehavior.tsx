import * as React from 'react';
import EntityService from 'services/Entity/EntityService';
import FormFieldFactory from 'services/Form/FormFieldFactory';
import { useFormikType } from 'services/Form/types';
import ApiClient from "services/Api/ApiClient";
import { Grid } from '@mui/material';
import { PropertySpec, ScalarProperty } from 'services/Api/ParsedApiSpecInterface';
import EntityInterface, { PropertiesList } from './EntityInterface';
import ViewFieldValue from 'services/Form/Field/ViewFieldValue';
import { StyledGroupLegend, StyledGroupGrid } from './DefaultEntityBehavior.styles';

export const initialValues = {};

export const validator = (values: any, properties: PropertiesList) => {

    const response: any = {};
    for (const idx in values) {

        const pattern: RegExp | undefined = (properties[idx] as ScalarProperty)?.pattern;
        if (pattern && !values[idx].match(pattern)) {
            response[idx] = 'invalid pattern';
        }
    }

    return response;
}

export const marshaller = (values: any, properties: PropertiesList) => {

    for (const idx in values) {

        const property: any = properties[idx];

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
export const unmarshaller = (row: any, properties: PropertiesList) => {

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

export const foreignKeyResolver = async (data: any, entityService: EntityService) => data;

export const foreignKeyGetter = async () => {
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

export const ListDecorator = (props: any) => {

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

    return value !== null
        ? value
        : '';
}

export const RowIcons = (props: any) => {
    return (
        <React.Fragment />
    );
};

export type FieldsetGroups = {
    legend: string | React.ReactElement,
    fields: Array<string>
}

export type EntityFormProps = EntityInterface & {
    create?: boolean,
    edit?: boolean,
    entityService: EntityService,
    formik: useFormikType,
    groups: Array<FieldsetGroups>,
    fkChoices: any,
    readOnlyProperties?: { [attribute: string]: boolean },
};

const Form = (props: EntityFormProps) => {

    const { entityService, formik, readOnlyProperties } = props;
    const { fkChoices } = props;

    const columns = entityService.getColumns();
    const columnNames = Object.keys(columns);

    let groups: Array<FieldsetGroups> = [];
    if (props.groups) {
        groups = props.groups;
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

    const [visualToggles, setVisualToggles] = React.useState(initialVisualToggles);

    const formOnChangeHandler = (e: React.ChangeEvent<any>): void => {

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
            {groups.map((group: FieldsetGroups, idx: number) => {

                const visible = group.fields.reduce(
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
                            {group.fields.map((columnName: string, idx: number) => {

                                const choices = fkChoices
                                    ? fkChoices[columnName]
                                    : null;

                                const visibilityStyles = visualToggles[columnName]
                                    ? { display: 'block' }
                                    : { display: 'none' };

                                const readOnly = readOnlyProperties && readOnlyProperties[columnName]
                                    ? true
                                    : false;

                                return (
                                    <Grid item xs={12} md={6} lg={4} key={idx} style={visibilityStyles}>
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


const View = (props: any) => {

    const { entityService, row }: { entityService: EntityService, row: any } = props;

    const columns = entityService.getColumns();
    const columnNames = Object.keys(columns);

    let groups: Array<FieldsetGroups> = [];
    if (props.groups) {
        groups = props.groups;
    } else {
        groups.push({
            legend: "",
            fields: columnNames
        });
    }

    return (
        <React.Fragment>
            {groups.map((group: FieldsetGroups, idx: number) => {
                return (
                    <div key={idx}>
                        <StyledGroupLegend>
                            {group.legend}
                        </StyledGroupLegend>
                        <StyledGroupGrid>
                            {group.fields.map((columnName: string, idx: number) => {

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

const fetchFks = (endpoint: string, properties: Array<string>, setter: Function) => {
    ApiClient.get(
        endpoint,
        {
            '_pagination': false,
            '_itemsPerPage': 100,
            '_properties': properties
        },
        async (data: any) => {
            setter(data);
        }
    );
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
    toStr: (row: any) => {
        return (row.id || '[*]');
    },
    RowIcons,
    Form,
    View,
    fetchFks,
    defaultOrderBy: 'id',
};

export default DefaultEntityBehavior;
