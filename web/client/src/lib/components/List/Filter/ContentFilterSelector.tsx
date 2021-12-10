import { useState } from 'react';
import { Grid, Button } from '@mui/material';
import { FkProperty, KeyValList, isPropertyFk, PropertySpec } from 'lib/services/api/ParsedApiSpecInterface';
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
    addCriteria: (data:CriteriaFilterValue) => void,
    path: string
    className?: string
}

export default function ContentFilterSelector(props: ContentFilterRowProps): JSX.Element {

    const {
        entityService,
        addCriteria,
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
    const [type, setType] = useState<SearchFilterType>(filters[name] || '');

    const filterLabels: KeyValList = {};
    for (const filter of (filters[name] || {})) {
        filterLabels[filter] = FilterIconFactory({ name: filter, includeLabel: true });
    }

    const nameSelectBoxSpec: PropertySpec = {
        type: 'string',
        enum: fieldNames,
        default: Object.keys(fieldNames)[0],
        label: _('Field'),
        required: true,
    };

    const typeSelectBoxSpec: PropertySpec = {
        type: 'string',
        enum: filterLabels,
        default: filters[name][0],
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
    }

    const initialValues: CriteriaFilterValue = {
        'name': nameSelectBoxSpec.default,
        'type': typeSelectBoxSpec.default,
        'value': ''
    };

    const searchFormik: useFormikType = useFormik({
        initialValues,
        onSubmit: async (values: CriteriaFilterValue, actions: FormikHelpers<CriteriaFilterValue>) => {
            addCriteria(values);
            actions.setValues({
                ...values,
                value: ''
            });
        }
    });

    const formFieldFactory = new FormFieldFactory(
        entityService,
        searchFormik,
        (e: FormOnChangeEvent): void => {
            switch(e.target.name) {
                case 'name':
                    setName(e.target.value);
                    break;
                case 'type':
                    setType(e.target.value);
                    break;
            }
            searchFormik.handleChange(e);
        }
    );

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
                </Grid >
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
                </Grid>
            </Grid >
        </form>
    );
}