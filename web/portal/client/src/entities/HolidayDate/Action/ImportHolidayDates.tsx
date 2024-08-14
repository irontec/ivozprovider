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

type ImportHolidayDatesMappingTablePropsType = {
  csv: Array<string>[];
  columns: string[];
  setColumns: (value: string[]) => void;
  ignoreFirstLine: boolean;
  setIgnoreFirstLine: (value: boolean) => void;
};

const ImportHolidayDatesMappingTable = (
  props: ImportHolidayDatesMappingTablePropsType
): JSX.Element => {
  const { columns, setColumns, csv, ignoreFirstLine, setIgnoreFirstLine } =
    props;

  const choices: DropdownChoices = [
    { id: 'name', label: _('Name') },
    { id: 'eventDate', label: _('Date') },
  ];

  const changeColumnMappingHandler = (event: SelectChangeEvent) => {
    const { name, value } = event.target;
    const newVal = [...columns];
    newVal[parseInt(name, 10)] = value;
    setColumns(newVal);
  };

  const changeIgnoreFirstLineHandler = (
    _: React.ChangeEvent<HTMLInputElement>,
    checked: boolean
  ) => {
    setIgnoreFirstLine(checked);
  };

  return (
    <>
      <StyledTable size='medium' sx={{ overflowY: 'auto' }}>
        <TableHead>
          <TableRow>
            {csv[0].map((_, key) => {
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

export default ImportHolidayDatesMappingTable;
