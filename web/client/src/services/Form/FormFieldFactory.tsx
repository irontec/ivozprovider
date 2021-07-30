import { FormControlLabel, TextField, Switch, FormHelperText, LinearProgress, FormControl, makeStyles, Theme } from '@material-ui/core';
import { ScalarProperty, FkProperty, PropertySpec } from 'services/Api/ParsedApiSpecInterface';
import EntityService from 'services/Entity/EntityService';
import { useFormikType } from './types';
import Dropdown from 'services/Form/Field/Dropdown';
import React from 'react';
import Autocomplete from './Field/Autocomplete';

export default class FormFieldFactory
{
    private styles:any;

    constructor(
        private entityService: EntityService,
        private formik: useFormikType,
        private changeHandler: (event: any) => void
    ) {
        this.styles = makeStyles((theme: Theme) => ({
            switch: {
                marginTop: '10px',
            },
            inputText: {
                marginTop: '0px',
            },
            linearProgress: {
                paddingTop: '60px',
            }
          }));
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
        const properties = this.entityService.getProperties();

        return (properties[fld] as PropertySpec);
    }

    private getInputField(fld:string, choices?:any)
    {
        const property = this.getProperty(fld);
        const disabled = (property as ScalarProperty).readOnly;
        const classes:any = this.styles();
        const multiSelect = (property as ScalarProperty).type === 'array';

        if ((property as FkProperty).$ref || multiSelect) {

            if (!choices) {
                return (<div className={classes.linearProgress}><LinearProgress /></div>);
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

            const enumValues:any = (property as ScalarProperty).enum;

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
                <FormControl className={classes.switch} fullWidth={true} variant="outlined">
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
                </FormControl>
            );
        }

        if ((property as ScalarProperty).type === 'integer') {

            return (
                <TextField
                    name={fld}
                    type="number"
                    value={this.formik.values[fld]}
                    disabled={disabled}
                    label={property.label}
                    InputLabelProps={{ shrink: true, required: property.required }}
                    onChange={this.changeHandler}
                    error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                    helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                    fullWidth={true}
                    className={classes.inputText}
                    margin="normal"
                    variant="outlined"
                />
            );
        }

        if ((property as ScalarProperty).type === 'string') {

            if ((property as ScalarProperty).format === 'date-time') {
                return (
                    <TextField
                        name={fld}
                        type="datetime-local"
                        value={this.formik.values[fld]}
                        inputProps={{
                            step: 1,
                        }}
                        disabled={disabled}
                        label={property.label}
                        InputLabelProps={{ shrink: true, required: property.required }}
                        onChange={this.changeHandler}
                        error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                        helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                        fullWidth={true}
                        className={classes.inputText}
                        margin="normal"
                        variant="outlined"
                    />
                );
            }

            if ((property as ScalarProperty).format === 'time') {
                return (
                    <TextField
                        name={fld}
                        type="time"
                        value={this.formik.values[fld]}
                        disabled={disabled}
                        label={property.label}
                        InputLabelProps={{ shrink: true, required: property.required }}
                        onChange={this.changeHandler}
                        error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                        helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                        fullWidth={true}
                        className={classes.inputText}
                        margin="normal"
                        variant="outlined"
                    />
                );
            }

            return (
                <TextField
                    name={fld}
                    type="text"
                    value={this.formik.values[fld]}
                    disabled={disabled}
                    label={property.label}
                    InputLabelProps={{ shrink: true, required: property.required }}
                    onChange={this.changeHandler}
                    error={this.formik.touched[fld] && Boolean(this.formik.errors[fld])}
                    helperText={this.formik.touched[fld] && this.formik.errors[fld]}
                    fullWidth={true}
                    className={classes.inputText}
                    margin="normal"
                    variant="outlined"
                />
            );
        }

        console.log('TODO FIELD TYPE', property);
        return (<span>TODO FIELD TYPE {(property as ScalarProperty).type}</span>)
    }
}