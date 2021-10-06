
import { styled } from '@mui/styles';
import { Theme, Typography, FormControl, TextField } from '@mui/material';

export const StyledSwitchFormControl = styled(
    (props) => {
        const { children, className } = props;
        return (<FormControl className={className} fullWidth={true}>{children}</FormControl>);
    }
)(
    ({ theme }: { theme: Theme }) => {
        return {
            marginTop: '10px',
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

export const StyledtextField = styled(
    (props) => {
        const { className, name, type, value, disabled, label, required, onChange, error, helperText, inputProps, InputProps } = props;
        return (
            <TextField
                name={name}
                type={type}
                value={value}
                disabled={disabled}
                label={label}
                InputLabelProps={{ shrink: true, required: required }}
                onChange={onChange}
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
        }
    }
);

export const StyledLinearProgress = styled('div')(
    ({ theme }: { theme: Theme }) => {
        return {
            paddingTop: '60px',
        }
    }
);
