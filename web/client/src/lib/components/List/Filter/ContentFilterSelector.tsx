import { useState } from 'react';
import { Grid, Button } from '@mui/material';
import { FkProperty, KeyValList, isPropertyFk, PropertySpec, ScalarProperty } from 'lib/services/api/ParsedApiSpecInterface';
import FormFieldFactory, { FormFieldFactoryChoices } from 'lib/services/form/FormFieldFactory';
import { FormOnChangeEvent, NullablePropertyFkChoices } from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import { FormikHelpers, useFormik } from 'formik';
import { useFormikType } from 'lib/services/form/types';
import EntityService from 'lib/services/entity/EntityService';
import FilterIconFactory, { SearchFilterType } from './icons/FilterIconFactory';
import { CriteriaFilterValue } from './ContentFilter';

interface ContentFilterRowProps {
    entityService: EntityService,
    fkChoices: { [fldName: string]: NullablePropertyFkChoices },
    addCriteria: (data: CriteriaFilterValue) => void,
    apply: (waitForStateUpdate:boolean) => void,
    path: string
    className?: string
}

export default function ContentFilterSelector(props: ContentFilterRowProps): JSX.Element {

    const {
        entityService,
        addCriteria,
        apply,
        path,
        fkChoices,
        className
    } = props;

    const columns = entityService.getCollectionParamList();
    const columnNames: Array<string> = Object.keys(columns);
    const filters: FormFieldFactoryChoices = {};

    for (const idx in columnNames) {
        const propertyName: string = columnNames[idx];
        filters[propertyName] = entityService.getPropertyFilters(propertyName, path);
    }

    const fieldNames: KeyValList = {};
    for (const fldName in filters) {
        fieldNames[fldName] = columns[fldName].label;
    }

    const [name, setName] = useState<string>(Object.keys(filters)[0]);
    const [type, setType] = useState<SearchFilterType>(filters[name][0] || '');

    const filterLabels: KeyValList = {};
    for (const filter of (filters[name] || {})) {
        filterLabels[filter] = FilterIconFactory({ name: filter, includeLabel: true });
    }

    const nameSelectBoxSpec: PropertySpec = {
        type: 'string',
        enum: fieldNames,
        default: name,
        label: _('Field'),
        required: true,
    };

    const typeSelectBoxSpec: PropertySpec = {
        type: 'string',
        enum: filterLabels,
        default: type,
        label: _('Filter'),
        required: true,
    };

    const valueBoxSpec: PropertySpec = {
        type: 'string',
        default: '',
        label: _('Value'),
        required: true,
    };

    const column = columns[name];
    if (isPropertyFk(column)) {
        (valueBoxSpec as FkProperty).$ref = column.$ref;
    } else if (column.enum) {
        (valueBoxSpec as ScalarProperty).enum = column.enum;
    }

    const initialValues: CriteriaFilterValue = {
        'name': nameSelectBoxSpec.default,
        'type': typeSelectBoxSpec.default,
        'value': ''
    };

    const searchFormik: useFormikType = useFormik({
        initialValues,
        validate: (values: CriteriaFilterValue) => {

            const response: any = {};
            const emptyValue = values.value === '' || values.value === undefined;
            if (emptyValue && values.type !== 'exact') {
                response.value = _('required value');
            }

            return response;
        },
        onSubmit: async (values: CriteriaFilterValue, actions: FormikHelpers<CriteriaFilterValue>) => {

            actions.setTouched({}, false);
            const dataFixes: Partial<CriteriaFilterValue> = {};

            addCriteria({
                ...values,
                ...dataFixes
            });

            actions.setValues({
                ...values,
                value: ''
            });
        }
    });

    if (!filters[name].includes(searchFormik.values.type)) {
        searchFormik.setValues({
            ...searchFormik.values,
            type: filters[name][0]
        });
    }

    const formFieldFactory = new FormFieldFactory(
        entityService,
        searchFormik,
        (e: FormOnChangeEvent): void => {
            switch (e.target.name) {
                case 'name':
                    setName(e.target.value);
                    searchFormik.handleChange({
                        target: {
                            name: 'value',
                            value: ''
                        }
                    });
                    searchFormik.setTouched({}, false);
                    break;
                case 'type':
                    setType(e.target.value);
                    break;
            }
            searchFormik.handleChange(e);
        },
        // eslint-disable-next-line @typescript-eslint/no-empty-function
        () => {}
    );

    const addAndApplyCallback = async () => {
        await searchFormik.submitForm();
        apply(true);
    }

    return (
        <form onSubmit={searchFormik.handleSubmit}>
            <Grid container={true} spacing={3} alignItems="flex-end" className={className}>
                <Grid item xs={12}>
                    {formFieldFactory.createByPropertySpec(
                        'name',
                        nameSelectBoxSpec,
                        {},
                        false
                    )}
                </Grid>
                <Grid item xs={12}>
                    {formFieldFactory.createByPropertySpec(
                        'type',
                        typeSelectBoxSpec,
                        {},
                        false
                    )}
                </Grid>
                <Grid item xs={12}>
                    {type !== 'exists' && formFieldFactory.createByPropertySpec(
                        'value',
                        valueBoxSpec,
                        fkChoices[name] || {},
                        false
                    )}
                </Grid>
                <Grid item xs={12}>
                    <Button variant="contained" type="submit">{_('Add')}</Button>
                    &nbsp;
                    <Button variant="contained" onClick={addAndApplyCallback}>
                        {_('Add and apply')}
                    </Button>
                </Grid>
            </Grid >
        </form>
    );
}