import { makeStyles, Theme } from '@material-ui/core';
import { PropertyCustomComponent, propertyCustomComponentProps, PropertySpec } from 'services/Api/ParsedApiSpecInterface';

interface CustomComponentWrapperProps extends propertyCustomComponentProps {
    property: PropertySpec,
    children: React.ReactElement,
};

const CustomComponentWrapper:PropertyCustomComponent<CustomComponentWrapperProps> = (props:CustomComponentWrapperProps) =>
{
    const {property} = props;
    const classes:any = styles();

    return (
        <div className={classes.fieldsetRoot}>
            <label className={classes.fieldsetLabel}>{property.label}</label>
            <div className={classes.fieldsetContainer}>
                <fieldset className={classes.fieldset}>
                    <legend className={classes.legend}>
                        <span>{property.label}</span>
                    </legend>
                    <div className={classes.customComponentContainer}>
                        {props.children}
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

export default CustomComponentWrapper;