import { styled } from '@mui/styles';
import { Theme, Typography, FormControl, TextField } from '@mui/material';

export const StyledSwitchFormControl = styled(
    (props) => {
        const { children, hasChanged } = props;
        let className = props.className;
        if (hasChanged) {
            className += ' changed';
        }

        return (<FormControl className={className} fullWidth={true}>{children}</FormControl>);
    }
)(
    ({ theme }: { theme: Theme }) => {
        return {
            marginTop: '10px',
            '&.changed label': {
                color: theme.palette.info.main
            }
        }
    }
);

export const StyledFilterDialogTypography = styled(
    (props) => {
        const { children, className } = props;
        return (<Typography variant="h6" className={className}>{children}</Typography>);
    }
)(
    ({ theme }: { theme: Theme }) => {
        return {
            marginLeft: theme.spacing(2),
            flex: 1,
        }
    }
);

export const StyledTextField = styled(
    (props) => {

        const {
            name, type, value, disabled, label,
            required, onChange, onBlur, error, helperText,
            inputProps, InputProps, hasChanged
        } = props;

        let className = props.className;
        if (hasChanged) {
            className += ' changed';
        }

        return (
            <TextField
                name={name}
                type={type}
                value={value}
                disabled={disabled}
                label={label}
                InputLabelProps={{ shrink: true, required: required }}
                onChange={onChange}
                onBlur={onBlur}
                error={error}
                helperText={helperText}
                fullWidth={true}
                className={className}
                margin="normal"
                inputProps={inputProps}
                InputProps={InputProps}
            />
        );
    }
)(
    ({ theme }: { theme: Theme }) => {
        return {
            marginTop: '0px',
            '&.changed > label': {
                color: theme.palette.info.main
            }
        }
    }
);

export const StyledLinearProgressContainer = styled('div')(
    () => {
        return {
            paddingTop: '52px',
        }
    }
);
