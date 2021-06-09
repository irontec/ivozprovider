import * as React from 'react';
import EntityService from 'services/Entity/EntityService';
import FormFieldFactory from 'services/Form/FormFieldFactory';
import { useFormikType } from 'services/Form/types';
import ApiClient from "services/Api/ApiClient";

export const initialValues = {};

export const validator = (values: any) => {
    return {};
}

export const marshaller = (values: any) => {

    for (const idx in values) {
        if (values[idx] !== '__null__') {
            continue;
        }

        values[idx] = null;
    }

    return values;
}

export const unmarshaller = (row: any) => {

    const normalizedData:any = {};

    // eslint-disable-next-line
    const dateTimePattern = `^[0-9]{4}\-[0-9]{2}\-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$`;
    const dateTimeRegExp = new RegExp(dateTimePattern);

    for (const idx in row) {
        if (row[idx] == null) {
            // formik doesn't like null values
            normalizedData[idx] = '';
        } else if (typeof row[idx] === 'object' && row[idx].id) {
            // flatten foreign keys
            normalizedData[idx] = row[idx].id;
        } else if (typeof row[idx] === 'string' && row[idx].match(dateTimeRegExp)) {
            // formik datetime format: "yyyy-MM-ddThh:mm" followed by optional ":ss" or ":ss.SSS"
            normalizedData[idx] = row[idx].replace(' ', 'T');
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

export const columns = {};

export const properties = {};

export const acl = {
    create: true,
    read: true,
    update: true,
    delete: true,
};

export const ListDecorator = (props: any) => {
    const {field, row} = props;
    return row[field] || '';
}

export const RowIcons = (props:any) => {
    return (
        <React.Fragment />
    );
};

const Form = (props: any) => {

    const { entityService, formik }: { entityService: EntityService, formik: useFormikType } = props;
    const { fkChoices } = props;
    const formFieldFactory = new FormFieldFactory(entityService, formik);

    const columns = entityService.getColumns();
    const columnNames = Object.keys(columns);

    return (
        <React.Fragment>
            {columnNames.map((columnName:string, idx: number) => {

                const choices = fkChoices
                    ? fkChoices[columnName]
                    : null;

                return (
                    <div key={idx}>
                        {formFieldFactory.getFormField(columnName, choices)}
                    </div>
                );
            })}
        </React.Fragment>
    );
};

const fetchFks = (endpoint: string, properties: Array<string>, setter: Function) =>
{
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
    RowIcons,
    Form,
    fetchFks,
    defaultOrderBy: 'id',
};

export default DefaultEntityBehavior;