import { FormControlLabel, TextField, Switch, FormHelperText, LinearProgress } from '@material-ui/core';
import { ScalarProperty, FkProperty, PropertySpec } from 'services/Api/ParsedApiSpecInterface';
import EntityService from 'services/Entity/EntityService';
import { useFormikType } from './types';
import Dropdown from 'services/Form/Field/Dropdown';
import React from 'react';

export default class FormFieldFactory
{
    constructor(
        private entityService: EntityService,
        private formik: useFormikType
    ) {
    }

    public getFormField(fld:string, choices?:any)
    {
        const property = this.getProperty(fld);
        if (!property) {
            console.error(`Property ${fld} was not found`);
            return null;
        }

        return (
            <React.Fragment>
                {this.getInputField(fld, choices)}
                {property.helpText && <FormHelperText variant={'outlined'}>
                    {property.helpText}
                </FormHelperText>}
            </React.Fragment>
        );
    }

    private getProperty(fld: string): PropertySpec
    {
        const properties = this.entityService.getColumns();

        return properties[fld];
    }

    private getInputField(fld:string, choices?:any)
    {
        const property = this.getProperty(fld);
        const disabled = (property as ScalarProperty).readOnly;

        if ((property as FkProperty).$ref) {

            if (!choices) {
                return (<div className={fld}><LinearProgress /></div>);
            }

            return (
                <Dropdown
                    name={fld}
                    label={property.label}
                    value={this.formik.values[fld]}
                    disabled={disabled}
                    onChange={this.formik.handleChange}
                    choices={choices}
                />
            );

        } else if ((property as ScalarProperty).type === 'boolean') {

            const checked = !!(this.formik.values[fld]);

            return (
                <FormControlLabel
                    control={<Switch
                        name={fld}
                        checked={checked}
                        disabled={disabled}
                        onChange={this.formik.handleChange}
                    />}
                    label={property.label}
                />
            );

        } else if ((property as ScalarProperty).type === 'integer') {

            return (
                <TextField
                    name={fld}
                    label={property.label}
                    value={this.formik.values[fld]}
                    disabled={disabled}
                    type="number"
                    InputLabelProps={{
                        shrink: true,
                    }}
                    onChange={this.formik.handleChange}
                    error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                    helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                    margin="normal"
                />
            );

        } else if ((property as ScalarProperty).type === 'string') {

            if ((property as ScalarProperty).enum) {

                const enumValues:any = (property as ScalarProperty).enum;

                if (Array.isArray(enumValues)) {
                    choices = choices || {};
                    for (const enumValue of enumValues) {
                        choices[enumValue] = enumValue;
                    }
                } else {
                    choices = enumValues;
                }

                return (
                    <Dropdown
                        name={fld}
                        label={property.label}
                        value={this.formik.values[fld]}
                        disabled={disabled}
                        onChange={this.formik.handleChange}
                        choices={choices}
                    />
                );

            } else if ((property as ScalarProperty).format === 'date-time') {
                return (
                    <TextField
                        name={fld}
                        type="datetime-local"
                        label={property.label}
                        value={this.formik.values[fld]}
                        disabled={disabled}
                        inputProps={{
                            step: 1,
                        }}
                        InputLabelProps={{
                          shrink: true,
                        }}
                        onChange={this.formik.handleChange}
                        error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                        helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                        margin="normal"
                    />
                );
            }

            return (
                <TextField
                    name={fld}
                    type="text"
                    label={property.label}
                    value={this.formik.values[fld]}
                    disabled={disabled}
                    onChange={this.formik.handleChange}
                    error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                    helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                    margin="normal"
                />
            );
        }

        return (<span>TODO FIELD TYPE {(property as ScalarProperty).type}</span>)
    }
}