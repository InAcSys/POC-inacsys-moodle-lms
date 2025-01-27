import { Dispatch, SetStateAction } from 'react';
import '../styles/input.css'

interface Props {
  inputName: string;
  id: string;
  labelText: string;
  type: string;
  changeValue: Dispatch<SetStateAction<string>>
  value: string
}

const Input = ({ inputName, id, labelText, type, changeValue, value }: Props) => {
  return (
    <>
      <label htmlFor={inputName} className="input-label">
        {labelText}
      </label>
      <input type={type} name={inputName} id={id} className="input-section" onChange={(e) => changeValue(e.target.value)} value={value} />
    </>
  );
};

export default Input;
