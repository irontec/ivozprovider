import { DropdownChoices } from '@irontec/ivoz-ui';
import { StyledTable } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import { StyledDropdown } from '@irontec/ivoz-ui/services/form/Field/Dropdown/Dropdown.styles';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import {
  Checkbox,
  SelectChangeEvent,
  TableBody,
  TableCell,
  TableHead,
  TableRow,
} from '@mui/material';

type ImportRatesMappingTablePropsType = {
  csv: Array<string>[];
  columns: string[];
  setColumns: (value: string[]) => void;
  ignoreFirstLine: boolean;
  setIgnoreFirstLine: (value: boolean) => void;
};

const ImportRatesMappingTable = (
  props: ImportRatesMappingTablePropsType
): JSX.Element => {
  const { csv, columns, setColumns, ignoreFirstLine, setIgnoreFirstLine } =
    props;

  const choices: DropdownChoices = [
    { id: 'ignore', label: 'Ignore' },
    { id: 'destinationName', label: 'Destination Name' },
    { id: 'destinationPrefix', label: 'Prefix' },
    { id: 'rateCost', label: 'Per minute charge' },
    { id: 'connectionCharge', label: 'Connection charge' },
    { id: 'rateIncrement', label: 'Charge period' },
  ];

  const changeColumnMappingHandler = (event: SelectChangeEvent) => {
    const { name, value } = event.target;
    const newVal = [...columns];
    newVal[parseInt(name, 10)] = value;
    setColumns(newVal);
  };

  const changeIgnoreFirstLineHandler = (
    event: React.ChangeEvent<HTMLInputElement>,
    checked: boolean
  ) => {
    setIgnoreFirstLine(checked);
  };

  return (
    <>
      <StyledTable size='medium' sx={{ overflowY: 'auto' }}>
        <TableHead>
          <TableRow>
            {csv[0].map((row, key) => {
              const value = columns[key] || 'ignore';

              return (
                <TableCell key={key}>
                  <StyledDropdown
                    name={`${key}`}
                    label={''}
                    value={value}
                    required={false}
                    disabled={false}
                    onChange={changeColumnMappingHandler}
                    onBlur={() => {
                      /* noop */
                    }}
                    choices={choices}
                    error={false}
                    errorMsg={''}
                    helperText={''}
                    hasChanged={false}
                  />
                </TableCell>
              );
            })}
          </TableRow>
        </TableHead>
        <TableBody>
          {csv.slice(0, 4).map((row, key) => {
            return (
              <TableRow key={key}>
                {row.map((column, columnKey) => {
                  const align = columnKey > 0 ? 'right' : 'left';

                  return (
                    <TableCell key={columnKey} sx={{ textAlign: align }}>
                      {column}
                    </TableCell>
                  );
                })}
              </TableRow>
            );
          })}
        </TableBody>
      </StyledTable>
      <p>
        <Checkbox
          name='ignoreFirstLine'
          value={ignoreFirstLine}
          onChange={changeIgnoreFirstLineHandler}
        />
        {_('Ignore first line.')}
      </p>
    </>
  );
};

export default ImportRatesMappingTable;
