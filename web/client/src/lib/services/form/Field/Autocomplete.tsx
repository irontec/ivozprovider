import React, { useEffect, useState, useCallback, ReactElement, JSXElementConstructor } from 'react';
import { TextField, } from '@mui/material';
import MuiAutocomplete from '@mui/material/Autocomplete';
import { getI18n } from 'react-i18next';

interface AutocompleteProps {
  className: string,
  name: string,
  label: string | ReactElement<any, string | JSXElementConstructor<any>>,
  value: any,
  multiple: boolean,
  required: boolean,
  disabled: boolean,
  onChange: (event: any) => void,
  onBlur: (event: React.FocusEvent) => void,
  choices: any,
  error?: boolean,
  helperText?: string,
  hasChanged: boolean,
}

const Autocomplete = (props: AutocompleteProps): JSX.Element | null => {

  const {
    name, label, required, multiple, disabled, onChange, onBlur,
    choices, error, helperText, hasChanged
  } = props;
  const value = props.value || null;
  const i18n = getI18n();

  let className = props.className;
  if (hasChanged) {
    className += ' changed';
  }

  const [arrayChoices, setArrayChoices] = useState<Array<any>>([]);

  useEffect(
    () => {

      const arrayValue = [];
      for (const idx in choices) {
        arrayValue.push({ value: idx, label: choices[idx] });
      }

      setArrayChoices(arrayValue);

    },
    [choices]
  );

  const onChangeWrapper = useCallback(
    (e: any, option: any) => {

      const selectedValue = multiple
        ? option.map((item: any) => typeof item === 'object' ? item.value : item)
        : option?.value;

      onChange({
        target: {
          name: name,
          value: selectedValue,
        }
      })
    },
    [multiple, onChange, name]
  );

  const getOptionLabel = useCallback(
    (value: any) => {

      if (typeof value !== 'object') {
        value = arrayChoices.find(
          // eslint-disable-next-line
          (option: any) => option.value == value
        );
      }

      const isTranslation =
        value?.label
        && typeof value.label === 'object'
        && value.label?.props?.defaults
        && typeof value.label?.props?.defaults === 'string';

      if (isTranslation) {

        const translatableText = value.label?.props?.defaults;

        return i18n.t(translatableText);
      }

      return value?.label || "";
    },
    [arrayChoices, i18n]
  );

  const isOptionEqualToValue = useCallback(
    (option: any, value: any): boolean => {
      // eslint-disable-next-line
      if (option.value == value) {
        return true;
      }

      return false;
    },
    []
  );

  const renderInput = useCallback(
    (params: any) => {

      const InputProps = {
        ...params.InputProps,
        notched: true,
      }

      return (
        <TextField
          {...params}
          name={name}
          label={label}
          InputProps={InputProps}
          InputLabelProps={{ shrink: true, required: required }}
          error={error}
          helperText={helperText}
        />
      );
    },
    [name, label, required, error, helperText]
  );

  return (
    <MuiAutocomplete
      className={className}
      value={value}
      multiple={multiple}
      disabled={disabled}
      onChange={onChangeWrapper}
      onBlur={onBlur}
      options={arrayChoices}
      getOptionLabel={getOptionLabel}
      isOptionEqualToValue={isOptionEqualToValue}
      filterSelectedOptions
      renderInput={renderInput}
    />
  );
};

export default Autocomplete;
