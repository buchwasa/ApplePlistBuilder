<?php /** @noinspection ALL */

class PlistBuilder{
	/** @var SimpleXMLElement */
	private $xml;

	public function __construct(string $bid, string $name, string $url){
		$this->xml = simplexml_load_string($this->getPlist());

		$this->setPlistBID($bid);
		$this->setPlistName($name);
		$this->setPlistURL($url);
	}

	public function getAssets(){
		return $this->xml->dict->array->dict->array->dict;
	}

	public function getMetadata(){
		return $this->xml->dict->array->dict->dict;
	}

	public function getPlistBID(){
		return $this->getMetadata()->string[0];
	}

	public function setPlistBID(string $bid){
		$this->getMetadata()->string[0] = $bid;
	}

	public function getPlistName(){
		return $this->getMetadata()->string[3];
	}

	public function setPlistName(string $name){
		$this->getMetadata()->string[3] = $name;
	}

	public function getPlistURL(){
		return $this->getAssets()->string[1];
	}

	public function setPlistURL(string $url){
		$this->getAssets()->string[1] = $url;
	}

	public function getPlist(){
		return <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
		<plist version="1.0">
            <dict>
                <key>items</key>
                <array>
                    <dict>
                        <key>assets</key>
                        <array>
                            <dict>
                                <key>kind</key>
                                <string>software-package</string>
                                <key>url</key>
                                <string></string>
                            </dict>
                        </array>
                        <key>metadata</key>
                        <dict>
                            <key>bundle-identifier</key>
                            <string></string>
                            <key>bundle-version</key>
                            <string>0.33.1</string>
                            <key>kind</key>
                            <string>software</string>
                            <key>title</key>
                            <string></string>
                        </dict>
                    </dict>
                </array>
            </dict>
        </plist>
XML;
	}
}
