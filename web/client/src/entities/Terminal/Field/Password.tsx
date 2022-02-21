import { InputAdornment, Tooltip } from '@mui/material';
import { isPropertyScalar } from 'lib/services/api/ParsedApiSpecInterface';
import { PropertyCustomFunctionComponent, PropertyCustomFunctionComponentProps, CustomFunctionComponentContext } from 'lib/services/form/Field/CustomComponentWrapper';
import { StyledTextField } from 'lib/services/form/FormFieldFactory.styles';
import { TerminalPropertyList } from '../TerminalProperties';
import AutorenewIcon from '@mui/icons-material/Autorenew';
import { styled } from '@mui/styles';

type TerminalValues = TerminalPropertyList<string | number>;
type PasswordType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<TerminalValues>>;

interface RegeneratePasswordIconProps {
    onClick: () => void,
    label: string
}

const RegeneratePasswordIcon = (props: RegeneratePasswordIconProps): JSX.Element => {

    const { label, ...rest } = props;

    return (
        <Tooltip title={label} enterTouchDelay={0}>
            <AutorenewIcon {...rest} />
        </Tooltip>
    );
}

const StyledRegeneratePasswordIcon = styled(RegeneratePasswordIcon)(
    () => {
        return {
            cursor: 'pointer',
        }
    }
);

const randomPass = (): string => {

    const alphabet = 'abcdefghijklmnopqrstuvwxyz';
    const digits = '0123456789';
    const simbols = '+*_-';

    const randomValFromString = (haystack: string, length: number): string => {
        let retVal = '';
        for (let i = 0, n = haystack.length; i < length; ++i) {
            retVal += haystack.charAt(Math.floor(Math.random() * n));
        }

        return retVal;
    }

    const shuffle = (str: string) => {
        return [...str]
            .sort(() => {
                return Math.random() - .5;
            })
            .join('');
    }

    let retVal = '';

    // 3 uppercase letters
    retVal += randomValFromString(alphabet.toUpperCase(), 3);
    // 3 lowercase letters
    retVal += randomValFromString(alphabet.toLowerCase(), 3);
    // 3 digits
    retVal += randomValFromString(digits, 3);
    // one character in '+*_-'
    retVal += randomValFromString(simbols, 1);

    return shuffle(retVal);
}

const Password: PasswordType = (props): JSX.Element => {

    const columnName = props._columnName as keyof TerminalValues;
    const { _context, values, disabled, property, changeHandler, formik } = props;


    if (!formik || _context === CustomFunctionComponentContext.read) {
        return (
            <>{values[columnName]}</>
        );
    }

    const inputProps: any = {}
    if (isPropertyScalar(property) && property.maxLength) {
        inputProps.maxLength = property.maxLength;
    }

    const passGenerator = () => {
        const pass = randomPass();
        const event = {
            target: {
                name: columnName,
                value: pass,
            }
        };

        formik.handleChange(event);
    }

    const InputProps = {
        endAdornment: (
            <InputAdornment position="end">
                <StyledRegeneratePasswordIcon
                    label={'Generate new secure password'}
                    onClick={passGenerator}
                />
            </InputAdornment>
        )
    }

    const hasChanged = formik.initialValues[columnName] != formik.values[columnName];

    return (
        <div>
            <StyledTextField
                name={columnName}
                type="text"
                value={values[columnName]}
                disabled={disabled}
                label={property.label}
                required={property.required}
                onChange={changeHandler}
                error={formik.touched[columnName] as boolean && Boolean(formik.errors[columnName])}
                helperText={formik.touched[columnName] as boolean && formik.errors[columnName] as string}
                inputProps={inputProps}
                InputProps={InputProps}
                hasChanged={hasChanged}
            />
        </div>
    );
}

export default Password;