<?php
class LocatorStrategyJavascript {
    /**Returns an element whose class name contains the search value; compound class names are not permitted.*/
    const className="getElementsByClassName";

    /**Returns an element matching a CSS selector.*/
    const cssSelector="querySelector";

    /**Returns an element whose ID attribute matches the search value.*/
    const id="getElementById";

    /**Returns an element whose NAME attribute matches the search value.*/
    const name="getElementsByName";

    /**Returns an element whose tag name matches the search value.*/
    const tagName="getElementById";
}