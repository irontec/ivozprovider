import {
  FormControl,
  InputLabel,
  MenuItem,
  Select,
  OutlinedInput,
  FormHelperText
} from '@mui/material';
import { JSXElementConstructor, ReactElement } from 'react';

interface SelectProps {
  className?: string,
  name: string,
  label: string | ReactElement<any, string | JSXElementConstructor<any>>,
  value: any,
  required: boolean,
  disabled: boolean,
  onChange: (event: any) => void,
  onBlur: (event: React.FocusEvent) => void,
  hasChanged: boolean,
  choices: any,
  error?: boolean,
  helperText?: string
}

const Dropdown = (props: SelectProps): JSX.Element => {

  const {
    name, label, value, required, disabled, onChange, onBlur,
    choices, error, helperText, hasChanged, className
  } = props;

  const labelId = `${name}-label`;

  const labelClassName = hasChanged
    ? 'changed'
    : '';

  return (
    <FormControl fullWidth={true} error={error} className={className}>
      <InputLabel required={required} shrink={true} className={labelClassName} id={labelId}>{label}</InputLabel>
      <Select
        value={value}
        disabled={disabled}
        onChange={onChange}
        onBlur={onBlur}
        displayEmpty={true}
        variant="outlined"
        input={
          <OutlinedInput
            name={name}
            type="text"
            label={label}
            notched={true}
          />
        }
      >
        {Object.entries(choices).filter(([, label]) => label !== false).map(([value, label]: [string, any], key: number) => {
          return (<MenuItem value={value} key={`${value}-${key}`}>{label}</MenuItem>);
        })}
      </Select>
      {helperText && <FormHelperText>{helperText}</FormHelperText>}
    </FormControl>
  );
};

export default Dropdown;
