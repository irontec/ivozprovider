import {
    FormControlLabel, Switch, FormHelperText, LinearProgress, InputAdornment
} from '@mui/material';
import { ScalarProperty, FkProperty, PropertySpec, isPropertyScalar, isPropertyFk } from 'lib/services/api/ParsedApiSpecInterface';
import { CustomFunctionComponentContext, PropertyCustomFunctionComponent } from 'lib/services/form/Field/CustomComponentWrapper';
import EntityService from 'lib/services/entity/EntityService';
import { useFormikType } from './types';
import StyledDropdown from 'lib/services/form/Field/Dropdown.styles';
import React from 'react';
import StyledAutocomplete from './Field/Autocomplete.styles';
import FileUploader from './Field/FileUploader';
import { StyledSwitchFormControl, StyledTextField, StyledLinearProgressContainer } from './FormFieldFactory.styles';
import { FormOnChangeEvent, PropertyFkChoices } from 'lib/entities/DefaultEntityBehavior';

export type FormFieldFactoryChoices = { [key: string | number]: any };
export type NullableFormFieldFactoryChoices = null | FormFieldFactoryChoices;

export default class FormFieldFactory {

    constructor(
        private entityService: EntityService,
        private formik: useFormikType,
        private changeHandler: (event: FormOnChangeEvent) => void,
        private handleBlur: (event: React.FocusEvent) => void,
    ) {
    }

    public getFormField(fld: string, choices: NullableFormFieldFactoryChoices, readOnly = false): JSX.Element | null {
        const property = this.getProperty(fld);
        if (!property) {
            console.error(`Property ${fld} was not found`);
            return null;
        }

        return this.createByPropertySpec(
            fld,
            property,
            choices,
            readOnly
        );
    }

    public createByPropertySpec(
        fld: string,
        property: PropertySpec,
        choices: NullableFormFieldFactoryChoices,
        readOnly = false
    ): JSX.Element | null {

        return (
            <React.Fragment>
                {this.getInputField(fld, property, choices, readOnly)}
                {property.helpText && <FormHelperText variant={'outlined'}>
                    {property.helpText}
                </FormHelperText>}
            </React.Fragment>
        );
    }

    private getProperty(fld: string): PropertySpec {
        const properties = this.entityService.getProperties();

        return (properties[fld] as PropertySpec);
    }

    private getInputField(fld: string, property: PropertySpec, choices: NullableFormFieldFactoryChoices, readOnly: boolean) {

        const disabled = property.readOnly || readOnly;
        const multiSelect = (property as ScalarProperty).type === 'array';
        const fileUpload = (property as ScalarProperty).type === 'file';
        const hasChanged = this.formik.initialValues[fld] != this.formik.values[fld];

        if (isPropertyScalar(property) && property.component) {

            const PropertyComponent = (property as ScalarProperty).component as PropertyCustomFunctionComponent<any>;

            return (
                <PropertyComponent
                    _context={CustomFunctionComponentContext.write}
                    _columnName={fld}
                    formik={this.formik}
                    values={this.formik.values}
                    property={property}
                    disabled={disabled}
                    changeHandler={this.changeHandler}
                    onBlur={this.handleBlur}
                />
            );
        }

        if (!fileUpload && ((property as FkProperty).$ref || multiSelect)) {

            if (!choices) {
                return (
                    <StyledLinearProgressContainer>
                        <LinearProgress />
                    </StyledLinearProgressContainer>
                );
            }

            if (property.null) {
                (choices as PropertyFkChoices)['__null__'] = property.null;
            }

            return (
                <StyledAutocomplete
                    name={fld}
                    label={property.label}
                    value={this.formik.values[fld]}
                    multiple={multiSelect}
                    required={property.required}
                    disabled={disabled}
                    onChange={this.changeHandler}
                    onBlur={this.handleBlur}
                    choices={choices}
                    error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                    helperText={this.formik.touched[fld] ? this.formik.errors[fld] as string : ''}
                    hasChanged={hasChanged}
                />
            );
        }

        if (isPropertyScalar(property) && property.enum) {

            const enumValues: any = property.enum;
            if (Array.isArray(enumValues)) {
                choices = choices || {};
                for (const enumValue of enumValues) {
                    choices[enumValue] = enumValue;
                }
            } else {
                choices = enumValues;
            }

            if (property.null) {
                (choices as PropertyFkChoices)['__null__'] = property.null;
            }

            let value = typeof this.formik.values[fld] === 'boolean'
                ? +this.formik.values[fld]
                : this.formik.values[fld];

            if (value === null) {
                value = '__null__';
            }

            return (
                <StyledDropdown
                    name={fld}
                    label={property.label}
                    value={value}
                    required={property.required}
                    disabled={disabled}
                    onChange={this.changeHandler}
                    onBlur={this.handleBlur}
                    choices={choices}
                    error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                    helperText={this.formik.touched[fld] ? this.formik.errors[fld] as string : ''}
                    hasChanged={hasChanged}
                />
            );
        }

        if (isPropertyScalar(property) && property.type === 'boolean') {

            const checked = Array.isArray(this.formik.values[fld])
                ? this.formik.values[fld].includes('1')
                : Boolean(this.formik.values[fld]);

            return (
                <StyledSwitchFormControl hasChanged={hasChanged}>
                    <FormControlLabel
                        disabled={disabled}
                        control={<Switch
                            name={fld}
                            checked={checked}
                            onChange={this.changeHandler}
                            onBlur={this.handleBlur}
                            value={true}
                        />}
                        label={property.label}
                    />
                </StyledSwitchFormControl>
            );
        }

        const inputProps: any = {};
        const InputProps: any = {};
        if (property.prefix) {
            InputProps.startAdornment = (
                <InputAdornment position="start">{property.prefix}</InputAdornment>
            );
        }

        if (isPropertyFk(property) && fileUpload) {
            const downloadModel = property.$ref.split('/').pop();
            const downloadAction = this.entityService.getItemByModel(downloadModel ?? '');
            const paths = downloadAction?.paths || [];
            const downloadPath = paths.length
                ? paths.pop().replace('{id}', this.formik.values.id)
                : null;

            return (
                <FileUploader
                    property={property as FkProperty}
                    _columnName={fld}
                    disabled={disabled}
                    formik={this.formik}
                    values={this.formik.values}
                    changeHandler={this.changeHandler}
                    onBlur={this.handleBlur}
                    downloadPath={downloadPath}
                    hasChanged={hasChanged}
                />
            );
        }

        if (isPropertyScalar(property) && property.type === 'integer') {

            if (property.minimum) {
                inputProps.min = property.minimum;
            }

            if (property.maximum) {
                inputProps.max = property.minimum;
            }

            return (
                <StyledTextField
                    name={fld}
                    type="number"
                    value={this.formik.values[fld]}
                    disabled={disabled}
                    label={property.label}
                    required={property.required}
                    onChange={this.changeHandler}
                    onBlur={this.handleBlur}
                    error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                    helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                    InputProps={InputProps}
                    hasChanged={hasChanged}
                />
            );
        }

        if (isPropertyScalar(property) && property.type === 'string') {

            if (property.format === 'date-time') {
                return (
                    <StyledTextField
                        name={fld}
                        type="datetime-local"
                        value={this.formik.values[fld]}
                        inputProps={{
                            step: 1,
                        }}
                        disabled={disabled}
                        label={property.label}
                        required={property.required}
                        onChange={this.changeHandler}
                        onBlur={this.handleBlur}
                        error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                        helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                        fullWidth={true}
                        InputProps={InputProps}
                        hasChanged={hasChanged}
                    />
                );
            }

            if (property.format === 'time') {
                return (
                    <StyledTextField
                        name={fld}
                        type="time"
                        value={this.formik.values[fld]}
                        disabled={disabled}
                        label={property.label}
                        required={property.required}
                        onChange={this.changeHandler}
                        onBlur={this.handleBlur}
                        error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                        helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                        InputProps={InputProps}
                        hasChanged={hasChanged}
                    />
                );
            }

            if (property.maxLength) {
                inputProps.maxLength = property.maxLength;
            }

            return (
                <StyledTextField
                    name={fld}
                    type="text"
                    value={this.formik.values[fld]}
                    disabled={disabled}
                    label={property.label}
                    required={property.required}
                    onChange={this.changeHandler}
                    onBlur={this.handleBlur}
                    error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                    helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                    InputProps={InputProps}
                    inputProps={inputProps}
                    hasChanged={hasChanged}
                />
            );
        }

        console.log('TODO FIELD TYPE', property);
        return (<span>TODO FIELD TYPE {(property as ScalarProperty).type}</span>)
    }
}