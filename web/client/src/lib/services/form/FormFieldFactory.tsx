import {
    FormControlLabel, Switch, FormHelperText, LinearProgress, InputAdornment
} from '@mui/material';
import { ScalarProperty, FkProperty, PropertySpec, PropertyCustomComponent } from 'lib/services/api/ParsedApiSpecInterface';
import EntityService from 'lib/services/entity/EntityService';
import { useFormikType } from './types';
import Dropdown from 'lib/services/form/Field/Dropdown';
import React from 'react';
import Autocomplete from './Field/Autocomplete';
import CustomComponentWrapper from './Field/CustomComponentWrapper';
import Alert from '@mui/material/Alert';
import FileUploader from './Field/FileUploader';
import { StyledSwitchFormControl, StyledtextField, StyledLinearProgress } from './FormFieldFactory.styles';

export default class FormFieldFactory {

    constructor(
        private entityService: EntityService,
        private formik: useFormikType,
        private changeHandler: (event: any) => void
    ) {
    }

    public getFormField(fld: string, choices?: any, readOnly: boolean = false) {
        const property = this.getProperty(fld);
        if (!property) {
            console.error(`Property ${fld} was not found`);
            return null;
        }

        return (
            <React.Fragment>
                {this.getInputField(fld, choices, readOnly)}
                {this.formik.errors[fld] && <Alert severity="error">{this.formik.errors[fld]}</Alert>}
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

    private getInputField(fld: string, choices: any, readOnly: boolean) {
        const property = this.getProperty(fld);

        const disabled = (property as ScalarProperty).readOnly || readOnly;

        const multiSelect = (property as ScalarProperty).type === 'array';
        const fileUpload = (property as ScalarProperty).type === 'file';

        if ((property as ScalarProperty).component) {

            const PropertyComponent = (property as ScalarProperty).component as PropertyCustomComponent<any>;

            return (
                <CustomComponentWrapper property={property}>
                    <PropertyComponent _context={'write'} _columnName={fld} {...this.formik.values} />
                </CustomComponentWrapper>
            );
        }

        if (!fileUpload && ((property as FkProperty).$ref || multiSelect)) {

            if (!choices) {
                return (<StyledLinearProgress><LinearProgress /></StyledLinearProgress>);
            }

            if (property.null) {
                choices['__null__'] = property.null;
            }

            return (
                <Autocomplete
                    name={fld}
                    label={property.label}
                    value={this.formik.values[fld]}
                    multiple={multiSelect}
                    required={property.required}
                    disabled={disabled}
                    onChange={this.changeHandler}
                    choices={choices}
                />
            );
        }

        if ((property as ScalarProperty).enum) {

            const enumValues: any = (property as ScalarProperty).enum;

            if (Array.isArray(enumValues)) {
                choices = choices || {};
                for (const enumValue of enumValues) {
                    choices[enumValue] = enumValue;
                }
            } else {
                choices = enumValues;
            }

            if (property.null) {
                choices['__null__'] = property.null;
            }

            return (
                <Dropdown
                    name={fld}
                    label={property.label}
                    value={this.formik.values[fld]}
                    required={property.required}
                    disabled={disabled}
                    onChange={this.changeHandler}
                    choices={choices}
                />
            );
        }

        if ((property as ScalarProperty).type === 'boolean') {

            const checked = !!(this.formik.values[fld]);

            return (
                <StyledSwitchFormControl>
                    <FormControlLabel
                        control={<Switch
                            name={fld}
                            checked={checked}
                            required={property.required}
                            disabled={disabled}
                            onChange={this.changeHandler}
                        />}
                        label={property.label}
                    />
                </StyledSwitchFormControl>
            );
        }

        const InputProps: any = {};
        if (property.prefix) {
            InputProps.startAdornment = (
                <InputAdornment position="start">{property.prefix}</InputAdornment>
            );
        }

        if (fileUpload) {

            return (
                <FileUploader
                    property={property}
                    columnName={fld}
                    values={this.formik.values}
                    changeHandler={this.changeHandler}
                />
            );
        }

        if ((property as ScalarProperty).type === 'integer') {

            return (
                <StyledtextField
                    name={fld}
                    type="number"
                    value={this.formik.values[fld]}
                    disabled={disabled}
                    label={property.label}
                    required={property.required}
                    onChange={this.changeHandler}
                    error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                    helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                    InputProps={InputProps}
                />
            );
        }

        if ((property as ScalarProperty).type === 'string') {

            if ((property as ScalarProperty).format === 'date-time') {
                return (
                    <StyledtextField
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
                        error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                        helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                        fullWidth={true}
                        InputProps={InputProps}
                    />
                );
            }

            if ((property as ScalarProperty).format === 'time') {
                return (
                    <StyledtextField
                        name={fld}
                        type="time"
                        value={this.formik.values[fld]}
                        disabled={disabled}
                        label={property.label}
                        required={property.required}
                        onChange={this.changeHandler}
                        error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                        helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                        InputProps={InputProps}
                    />
                );
            }

            return (
                <StyledtextField
                    name={fld}
                    type="text"
                    value={this.formik.values[fld]}
                    disabled={disabled}
                    label={property.label}
                    required={property.required}
                    onChange={this.changeHandler}
                    error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                    helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                    InputProps={InputProps}
                />
            );
        }

        console.log('TODO FIELD TYPE', property);
        return (<span>TODO FIELD TYPE {(property as ScalarProperty).type}</span>)
    }
}