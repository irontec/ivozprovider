import { makeStyles, Theme } from '@material-ui/core';
import { ScalarProperty } from 'services/Api/ParsedApiSpecInterface';
import React from 'react';

const CustomComponent = (props:any) =>
{
    const {property, values, columnName} = props;
    const classes:any = styles();

    const PropertyComponent = (property as ScalarProperty).component as React.FunctionComponent<any>;

    return (
        <div className={classes.fieldsetRoot}>
            <label className={classes.fieldsetLabel}>{property.label}</label>
            <div className={classes.fieldsetContainer}>
                <fieldset className={classes.fieldset}>
                    <legend className={classes.legend}>
                        <span>{property.label}</span>
                    </legend>
                    <div className={classes.customComponentContainer}>
                        <PropertyComponent  _context={'write'} _columnName={columnName} {...values} />
                    </div>
                </fieldset>
            </div>
        </div>
    );
}

const styles = makeStyles((theme: Theme) => {
    var borderColor = theme.palette.type === 'light'
        ? 'rgba(0, 0, 0, 0.23)'
        : 'rgba(255, 255, 255, 0.23)';

    return {
        fieldsetRoot: {
            display: 'inline-flex',
            flexDirection: 'column',
            position: 'relative',
            // Reset fieldset default style.
            minWidth: 0,
            padding: 0,
            margin: '0 0 8px 0',
            border: 0,
            verticalAlign: 'top', // Fix alignment issue on Safari.
            width: '100%',
            borderRadius: '4px',
        },
        fieldsetContainer: {
            position: 'relative',
            top: '-5px',
        },
        fieldsetLabel: {
            transform: 'translate(21px, -9px) scale(0.75)',
            transformOrigin: 'top left',
            color: theme.palette.text.secondary,
            fontSize: '1rem',
            zIndex: 1,
            pointerEvents: 'none',
            top: 0,
            left: 0,
            position: 'absolute',
        },
        fieldset: {
            position: 'relative',
            top: '-5px',
            borderRadius: theme.shape.borderRadius,
            borderColor: borderColor,
        },
        legend: {
            visibility: 'hidden',
            fontSize: '0.8rem',
        },
        customComponentContainer: {
            padding: '0 5px',
            fontSize: '1rem',
            color: theme.palette.text.secondary,
        },
    };
});

export default CustomComponent;