import { withRouter } from "react-router-dom";
import ReactDOMServer from 'react-dom/server';
import { useEffect, useState, useCallback } from 'react';
import { TextField, } from '@material-ui/core';
import MuiAutocomplete from '@material-ui/lab/Autocomplete';
import EntityInterface from 'entities/EntityInterface';

interface AutocompleteProps extends EntityInterface {
  name: string,
  label: string,
  value:any,
  multiple: boolean,
  required:boolean,
  disabled:boolean,
  onChange: (event: any) => void,
  choices: any
}

const Autocomplete = (props: AutocompleteProps) => {

  const { name, label, required, multiple, disabled, onChange, choices } = props;
  const value = props.value || null;

  const [arrayChoices, setArrayChoices] = useState<Array<any>>([]);
  const [loading, setLoading] = useState<boolean>(true);

  useEffect(
    () => {
      const arrayValue = [];
      for (const idx in choices) {
        arrayValue.push({value: idx, label: choices[idx]});
      }

      setArrayChoices(arrayValue);
      setLoading(false);

      return function umount() {};
    },
    [choices]
  );

  const onChangeWrapper = useCallback(
    (e:any, option:any) => {

      const selectedValue = multiple
        ? option.map((item:any) => typeof item === 'object' ? item.value : item)
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
    (value:any) => {

      if (typeof value !== 'object') {
        value = arrayChoices.find(
          // eslint-disable-next-line
          (option:any) => option.value == value
        );
      }

      if (value?.label && typeof value.label === 'object') {
        return ReactDOMServer.renderToStaticMarkup(
          value.label
        );
      }

      return value?.label || "";
    },
    [arrayChoices]
  );

  const getOptionSelected = useCallback(
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
    (params:any) => {

      const InputProps = {
        ...params.InputProps,
        notched: true,
      }

      return (
        <TextField
          {...params}
          name={name}
          variant="outlined"
          label={label}
          InputProps={InputProps}
          InputLabelProps={{ shrink: true, required: required }}
        />
      );
    },
    [name, label, required]
  );

  if (loading) {
    return null;
  }

  return (
      <MuiAutocomplete
        value={value}
        multiple={multiple}
        disabled={disabled}
        onChange={onChangeWrapper}
        options={arrayChoices}
        getOptionLabel={getOptionLabel}
        getOptionSelected={getOptionSelected}
        filterSelectedOptions
        renderInput={renderInput}

      />
  );
};

export default withRouter<any, any>(Autocomplete);
